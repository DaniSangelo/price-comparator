import { z } from 'zod';

export const SearchProductsQuerySchema = z.object({
    query: z.string().min(1, 'Query must be at least 1 character long').max(100, 'Query must be at most 100 characters long'),
    page: z.coerce.number().int().positive().default(1),
    limit: z.coerce.number().int().positive().min(1).max(200).default(20),
});

export type SearchProductsQuery = z.infer<typeof SearchProductsQuerySchema>;