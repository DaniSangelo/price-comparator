import { describe, it, expect, vi, beforeEach, afterEach } from 'vitest';
import { WinstonLogger } from './WinstonLogger';
import { requestContext } from '../http/context/requestContext';

const { mockInfo, mockError } = vi.hoisted(() => {
    return {
        mockInfo: vi.fn(),
        mockError: vi.fn(),
    };
});

vi.mock('winston', async (importOriginal) => {
    const actual = await importOriginal<typeof import('winston')>();
    return {
        ...actual,
        default: {
            ...actual.default,
            createLogger: vi.fn().mockReturnValue({
                info: mockInfo,
                error: mockError,
            }),
            format: actual.format,
            transports: actual.transports
        },
    };
});


describe('WinstonLogger', () => {
    let logger: WinstonLogger;

    beforeEach(() => {
        vi.clearAllMocks();
        logger = new WinstonLogger();
    });

    afterEach(() => {
        vi.clearAllMocks();
    });

    it('should log info with message and context', () => {
        logger.info('test message', { key: 'value' });
        expect(mockInfo).toHaveBeenCalledWith('test message', { key: 'value', requestId: '' });
    });

    it('should log error with message and context', () => {
        logger.error('error message', { error: 'details' });
        expect(mockError).toHaveBeenCalledWith('error message', { error: 'details', requestId: '' });
    });

    it('should include request context in logs', async () => {
        await requestContext.run({ requestId: '12345' }, () => {
            logger.info('context message');
            expect(mockInfo).toHaveBeenCalledWith('context message', { requestId: '12345' });
        });
    });
});
