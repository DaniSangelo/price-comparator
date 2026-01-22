import { describe, it, expect, vi, beforeEach, afterEach } from 'vitest';
import { SearchProductsUseCase } from './SearchProductsUseCase';
import { ILogger } from '../../../domain/ports/ILogger';
import { InMemoryProductRepository } from '../../../infrastructure/db/InMemoryProductRepository';
import { Product } from '../../../domain/entities/Product';

describe('SearchProductsUseCase', () => {
    let useCase: SearchProductsUseCase;
    let repository: InMemoryProductRepository;
    let mockLogger: ILogger;

    beforeEach(() => {
        repository = new InMemoryProductRepository();

        mockLogger = {
            info: vi.fn(),
            error: vi.fn(),
        } as unknown as ILogger;

        useCase = new SearchProductsUseCase(repository, mockLogger);
    });

    afterEach(() => {
        vi.clearAllMocks();
    });

    it('should execute search via repository and log info', async () => {
        const query = { query: 'Milk', page: 1, limit: 10 };
        const result = await useCase.execute(query);

        expect(mockLogger.info).toHaveBeenCalledWith('Start searching products', query);
        expect(mockLogger.info).toHaveBeenCalledWith('Products found', { count: 0 });
        expect(result).toEqual({ items: [], total: 0 });
    });

    it('should execute search function and return filtered data', async () => {
        const query = { query: 'Dairy', page: 1, limit: 10 };

        const product1: Product = {
            id: '1',
            title: 'Arroz',
            description: 'Rice',
            price: '10',
            inStock: true,
            currency: 'EUR',
            brand: 'Brand A',
            image: 'img.jpg',
            category: 'Dairy',
            createdAt: new Date(),
            updatedAt: new Date(),
        };

        const product2: Product = {
            id: '2',
            title: 'Feijão',
            description: 'Beans',
            price: '10',
            inStock: true,
            currency: 'EUR',
            brand: 'Brand B',
            image: 'img.jpg',
            category: 'Legumes',
            createdAt: new Date(),
            updatedAt: new Date(),
        };

        const targetProduct: Product = {
            id: '3',
            title: 'Amazing Dairy Milk',
            description: 'Best milk',
            price: '2',
            inStock: true,
            currency: 'EUR',
            brand: 'Brand C',
            image: 'img.jpg',
            category: 'Dairy',
            createdAt: new Date(),
            updatedAt: new Date(),
        };

        repository.add(product1);
        repository.add(product2);
        repository.add(targetProduct);

        const result = await useCase.execute(query);

        expect(result?.total).toBe(1);
        expect(result?.items[0].id).toBe('3');
    });

    it('should log error and return null on exception', async () => {
        const query = { query: 'Milk', page: 1, limit: 10 };
        const error = new Error('Database error');

        vi.spyOn(repository, 'search').mockRejectedValue(error);

        const result = await useCase.execute(query);

        expect(mockLogger.info).toHaveBeenCalledWith('Start searching products', query);
        expect(mockLogger.error).toHaveBeenCalledWith('Error searching products', error.message);
        expect(result).toBeNull();
    });
});
