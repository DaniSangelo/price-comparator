import { IProductRepository } from "../../domain/ports/IProductRepository";
import { Product } from "../../domain/entities/Product";
import { SearchProductsQuery } from "../../application/usecases/SearchProducts/SearchProductsQuerySchema";

export class InMemoryProductRepository implements IProductRepository {
    public products: Product[] = [];

    async search(query: SearchProductsQuery): Promise<{ items: Product[]; total: number; } | null> {
        const { query: searchQuery, page = 1, limit = 20 } = query;
        const normalizedQuery = searchQuery.toLowerCase();

        const filtered = this.products.filter(p => 
            p.title.toLowerCase().includes(normalizedQuery) ||
            p.description.toLowerCase().includes(normalizedQuery)
        );

        const total = filtered.length;
        const start = (page - 1) * limit;
        const end = start + limit;
        const items = filtered.slice(start, end);

        return { items, total };
    }

    // Helper for tests
    add(product: Product) {
        this.products.push(product);
    }
}
