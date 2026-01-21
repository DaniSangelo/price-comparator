import { SearchProductsUseCase } from "../application/usecases/SearchProducts/SearchProductsUseCase";
import { DrizzleProductRepository } from "../infrastructure/db/repositories/DrizzleProductRepository";
import { ProductController } from "../infrastructure/http/controllers/ProductController";
import { WinstonLogger } from "../infrastructure/logging/WinstonLogger";

export function makeProductControllerFactory() {
    const logger = new WinstonLogger();
    const repository = new DrizzleProductRepository();
    const useCase = new SearchProductsUseCase(repository, logger);
    return new ProductController(useCase);
}