import { ILogger } from "../../domain/ports/ILogger";
import winston from "winston";
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
                    format: 'DD-MM-YYYY HH:mm:ss',
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
                instance: process.env.HOSTNAME,
                env: process.env.NODE_ENV,
            }
        })
    }

    info(message: string, context?: Record<string, any>): void {
        this.logger.info(message, context);
    }
    error(message: string, context?: Record<string, any>): void {
        this.logger.error(message, context);
    }
}