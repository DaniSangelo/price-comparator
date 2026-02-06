using Lidl.Application.Ports;
using Lidl.Domain.Entities;
using Microsoft.Extensions.Logging;

namespace Lidl.Application.UseCases.SearchProducts;

public sealed class SearchProductsUseCase
{
    private readonly IProductRepository _productRepository;
    private readonly ILogger<SearchProductsUseCase> _logger;

    public SearchProductsUseCase(IProductRepository productRepository, ILogger<SearchProductsUseCase> logger)
    {
        _productRepository = productRepository;
        _logger = logger;
    }

    public async Task<SearchProductsOutput> ExecuteAsync(SearchProductsInput input, CancellationToken cancellationToken = default)
    {
        _logger.LogInformation("Searching products {Input}", input);
        var page = Math.Max(1, input.Page);
        var limit = Math.Clamp(input.Limit, 1, 200);
        input.Page = page;
        input.Limit = limit;

        var (items, total) = await _productRepository.SearchAsync(input, cancellationToken);
        var itemsDto = items.Select(MapToDto).ToList();
        _logger.LogInformation("Products found: {Total}", total);
        return new SearchProductsOutput(
            Items: itemsDto,
            Meta: new
            { 
                total,
                page,
                limit,
                last_page = Math.Ceiling((double)total / limit) 
            }
        );
    }

    private static SearchProductsItemDto MapToDto(Product product) => new(product.Id, product.Name, product.Description, product.Category, product.Price, product.Currency, product.InStock, product.Brand, product.Image, product.UpdatedAt);
}