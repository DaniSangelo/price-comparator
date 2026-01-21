import express from "express";
import { WinstonLogger } from "./infrastructure/logging/WinstonLogger";
import dotenv from "dotenv";
import { buildRoutes } from "./infrastructure/http/routes";
import { ProductController } from "./infrastructure/http/controllers/ProductController";
import { SearchProductsUseCase } from "./application/usecases/SearchProducts/SearchProductsUseCase";
import { DrizzleProductRepository } from "./infrastructure/db/repositories/DrizzleProductRepository";
dotenv.config();

const app = express();
app.use(express.json());
const logger = new WinstonLogger();

const routes = buildRoutes(
    new ProductController(
        new SearchProductsUseCase(
            new DrizzleProductRepository(),
            logger,
        )
    )
);

app.use(routes);

const port = Number(process.env.PORT) || 3333;

app.listen(port, '0.0.0.0', () => {
    logger.info(`${process.env.APP_NAME} server started on port ${port}`);
});