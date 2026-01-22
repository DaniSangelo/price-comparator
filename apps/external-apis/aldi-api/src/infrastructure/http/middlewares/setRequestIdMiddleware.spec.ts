import { describe, it, expect, vi, afterAll } from 'vitest';
import { setRequestIdMiddleware } from './setRequestIdMiddleware';
import { Request, Response, NextFunction } from 'express';
import { requestContext } from '../context/requestContext';

vi.mock('crypto', () => ({
    randomUUID: () => 'generated-uuid',
}));

describe('setRequestIdMiddleware', () => {
    afterAll(() => {
        vi.clearAllMocks();
    });

    it('should use existing x-request-id header', () => {
        const req = { headers: { 'x-request-id': 'existing-id' } } as unknown as Request;
        const res = { locals: {}, header: vi.fn() } as unknown as Response;
        const next = vi.fn();

        const runSpy = vi.spyOn(requestContext, 'run');

        setRequestIdMiddleware(req, res, next);

        expect(req.headers['x-request-id']).toBe('existing-id');
        expect(res.locals.requestId).toBe('existing-id');
        expect(res.header).toHaveBeenCalledWith('x-request-id', 'existing-id');
        expect(runSpy).toHaveBeenCalledWith({ requestId: 'existing-id' }, expect.any(Function));
        
        const runCallback = runSpy.mock.calls[0][1];
        runCallback();
        expect(next).toHaveBeenCalled();
    });

    it('should generate new x-request-id if missing', () => {
        const req = { headers: {} } as unknown as Request;
        const res = { locals: {}, header: vi.fn() } as unknown as Response;
        const next = vi.fn();

        const runSpy = vi.spyOn(requestContext, 'run');

        setRequestIdMiddleware(req, res, next);

        expect(req.headers['x-request-id']).toBe('generated-uuid');
        expect(res.locals.requestId).toBe('generated-uuid');
        expect(res.header).toHaveBeenCalledWith('x-request-id', 'generated-uuid');
        expect(runSpy).toHaveBeenCalledWith({ requestId: 'generated-uuid' }, expect.any(Function));

        const runCallback = runSpy.mock.calls[0][1];
        runCallback();
        expect(next).toHaveBeenCalled();
    });
});
