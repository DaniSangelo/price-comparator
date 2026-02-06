using Lidl.Application.UseCases.SearchProducts;
using Lidl.Domain.Entities;

namespace Lidl.Application.Ports;

public interface IProductRepository
{
    Task<(IReadOnlyList<Product> Items, long Total)> SearchAsync(SearchProductsInput input, CancellationToken ct = default);
}