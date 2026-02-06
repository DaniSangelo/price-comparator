namespace Lidl.Application.UseCases.SearchProducts;

public sealed record SearchProductsItemDto(
    Guid Id,
    string Name,
    string Description,
    string Category,
    decimal Price,
    string Currency,
    bool InStock,
    string? Brand,
    string? Image,
    DateTime UpdatedAt
);