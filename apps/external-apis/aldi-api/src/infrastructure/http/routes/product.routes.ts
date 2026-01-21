import { Router } from "express";
import { makeProductControllerFactory } from "../../../factories/makeProductControllerFactory";

const productRouter = Router()
const controller = makeProductControllerFactory();

productRouter.get('', controller.index);

export default productRouter;