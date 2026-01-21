import { Product } from "../../../domain/entities/Product";

export type SearchProductsOutput = {
    items: Product[];
    total: number;
}