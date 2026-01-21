import { Router } from "express";
import { ProductController } from "./controllers/ProductController";

export function buildRoutes(controller: ProductController) {
    const router = Router();

    router.get('/api/products', controller.index);

    return router;
}