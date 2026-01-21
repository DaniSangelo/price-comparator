import { SearchProductsQuery } from "../../application/usecases/SearchProducts/SearchProductsQuerySchema";
import { Product } from "../entities/Product";

export interface IProductRepository {
    search(query: SearchProductsQuery): Promise<{items: Product[], total: number} | null>;
}