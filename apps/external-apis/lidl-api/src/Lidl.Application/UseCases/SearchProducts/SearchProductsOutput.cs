namespace Lidl.Application.UseCases.SearchProducts;

public sealed record SearchProductsOutput(
    IReadOnlyList<SearchProductsItemDto> Items,
    object? Meta = null
);