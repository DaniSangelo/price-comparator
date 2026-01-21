import { unknown } from "zod";
import { ILogger } from "../../../domain/ports/ILogger";
import { IProductRepository } from "../../../domain/ports/IProductRepository";
import { SearchProductsOutput } from "./SearchProductsOutput";
import { SearchProductsQuery } from "./SearchProductsQuerySchema";

export class SearchProductsUseCase {
    constructor(
        private repository: IProductRepository,
        private logger: ILogger
    ) {}

    async execute(query: SearchProductsQuery): Promise<SearchProductsOutput | null> {
        try {
            this.logger.info('Start searching products', query);
            const result = await this.repository.search(query);
            this.logger.info('Products found', { count: result?.total });
            return result;
        } catch (error: any) {
            this.logger.error('Error searching products', error?.message);
            return null;
        }
    }
}