import { ILogger } from "../../domain/ports/ILogger";
import winston from "winston";
import { getRequestContext } from "../http/context/requestContext";
import os from "node:os";

const { combine, json, timestamp, colorize, printf } = winston.format;
const { Console } = winston.transports;

export class WinstonLogger implements ILogger {
    private logger: winston.Logger;

    constructor() {
        this.logger = winston.createLogger({
            level: process.env.LOG_LEVEL || 'info',
            format: combine(
                json(),
                timestamp({
                    format: 'YYYY-MM-DD HH:mm:ss',
                }),
                colorize({all: true}),
                printf( ({ level, message, timestamp , ...metadata}) => {
                    let msg = `${timestamp} [${level}]: ${message} `
                    if(metadata) {
                        msg += JSON.stringify(metadata)
                    }
                    return msg
                }),
            ),
            transports:[ new Console()],
            defaultMeta: {
                service: process.env.APP_NAME,
                instance: os.hostname(),
                env: process.env.NODE_ENV,
            }
        })
    }

    info(message: string, context?: Record<string, any>): void {
        const ctx = getRequestContext();
        this.logger.info(message, {...context, ...ctx});
    }

    error(message: string, context?: Record<string, any>): void {
        const ctx = getRequestContext();
        this.logger.error(message, {...context, ...ctx});
    }
}