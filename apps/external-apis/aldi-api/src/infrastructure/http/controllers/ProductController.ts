import { Request, Response } from "express";
import { SearchProductsQuerySchema } from "../../../application/usecases/SearchProducts/SearchProductsQuerySchema";
import { SearchProductsUseCase } from "../../../application/usecases/SearchProducts/SearchProductsUseCase";

export class ProductController {
    constructor(private useCase: SearchProductsUseCase) {}

    index = async (req: Request, res: Response) => {
        const parsed = SearchProductsQuerySchema.safeParse(req.query);

        if(!parsed.success) {
            return res.status(400).json({
                message: 'Invalid query parameters',
                errors: parsed.error.issues,
            })
        }

        const result = await this.useCase.execute(parsed.data);

        if(!result) {
            return res.status(404).json({
                message: 'Products not found'
            })
        }

        return res.json({
            data: result?.items,
            meta: {
                page: parsed.data.page,
                limit: parsed.data.limit,
                total: result?.total,
                last_page: Math.ceil(result.total / parsed.data.limit),
            },
            links: {
                self: req.url,
                next: parsed.data.page < Math.ceil(result.total / parsed.data.limit) ? `${req.url}&page=${parsed.data.page + 1}` : null,
                prev: parsed.data.page > 1 ? `${req.url}&page=${parsed.data.page - 1}` : null,
                first: parsed.data.page > 1 ? `${req.url}&page=1` : null,
                last: parsed.data.page < Math.ceil(result.total / parsed.data.limit) ? `${req.url}&page=${Math.ceil(result.total / parsed.data.limit)}` : null,
            }
        })
    }
}