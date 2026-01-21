import express from "express";
import { WinstonLogger } from "./infrastructure/logging/WinstonLogger";
import dotenv from "dotenv";
import routes from "./infrastructure/http/routes";
dotenv.config();

const app = express();
app.use(express.json());
const logger = new WinstonLogger();

app.use('/api', routes);

const port = Number(process.env.PORT) || 3333;

app.listen(port, '0.0.0.0', () => {
    logger.info(`${process.env.APP_NAME} server started on port ${port}`);
});