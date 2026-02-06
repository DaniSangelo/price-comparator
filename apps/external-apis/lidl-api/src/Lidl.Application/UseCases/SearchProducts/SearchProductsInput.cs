namespace Lidl.Application.UseCases.SearchProducts;

public sealed class SearchProductsInput
{
    public string? Query { get; set; }
    public int Page { get; set; } = 1;
    public int Limit { get; set; } = 20;

    public SearchProductsInput(string? query, int page, int limit)
    {
        Query = query;
        Page = page;
        Limit = limit;
    }
}