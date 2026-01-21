import { IProductRepository } from "../../../domain/ports/IProductRepository";
import { SearchProductsQuery } from "../../../application/usecases/SearchProducts/SearchProductsQuerySchema";
import { Product } from "../../../domain/entities/Product";
import { db } from "../drizzle";
import { products } from "../schema";
import { and, eq, ilike, sql } from "drizzle-orm";
import { SearchProductsOutput } from "../../../application/usecases/SearchProducts/SearchProductsOutput";

export class DrizzleProductRepository implements IProductRepository {
    async search(query: SearchProductsQuery): Promise<SearchProductsOutput | null> {
        const { page, limit, query: searchTerm } = query;

        const where = searchTerm
            ? and(eq(products.inStock, true), ilike(products.title, `%${searchTerm}%`))
            : eq(products.inStock, true);

        const offset = (page - 1) * limit;

        const rows = await db
            .select()
            .from(products)
            .where(where)
            .limit(limit)
            .offset(offset)

        const countRows = await db
            .select({ count: sql<number>`count(*)` })
            .from(products)
            .where(where)

        const total = countRows[0].count ?? 0;

        const items: Product[] = rows.map((item) => ({
            id: item.id,
            title: item.title,
            description: item.description,
            category: item.category,
            price: item.price,
            image: item.image,
            currency: item.currency,
            brand: item.brand,
            inStock: item.inStock,
            createdAt: item.createdAt,
            updatedAt: item.updatedAt,
        }))

        return { items, total };
    }
}