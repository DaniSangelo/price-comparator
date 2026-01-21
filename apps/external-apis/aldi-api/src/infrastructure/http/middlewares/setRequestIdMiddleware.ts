import { NextFunction, Request, Response } from "express";
import { randomUUID } from "crypto";

export function setRequestIdMiddleware(req: Request, res: Response, next: NextFunction): void {
    const requestId = req.headers['x-request-id'] || randomUUID();
    req.headers['x-request-id'] = requestId;
    res.locals.requestId = requestId;
    res.header('x-request-id', requestId);
    next();
}