export interface ILogger {
    info(message: string, context?: Record<string, any>): void;
    error(message: string, context?: Record<string, any>): void;
}