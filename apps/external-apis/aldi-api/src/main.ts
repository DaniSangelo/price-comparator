import express from "express";
import { WinstonLogger } from "./infrastructure/logging/WinstonLogger";
import dotenv from "dotenv";
dotenv.config();

const app = express();
app.use(express.json());
const logger = new WinstonLogger();
const port = Number(process.env.PORT) || 3333;

app.listen(port, () => {
    logger.info(`${process.env.APP_NAME} server started on port ${port}`);
});