using Lidl.Application.Ports;
using Lidl.Application.UseCases.SearchProducts;
using Lidl.Domain.Entities;

namespace Lidl.Infrastructure.Repositories.InMemory;

public sealed class InMemoryProductRepository : IProductRepository
{
    private readonly List<Product> _items = [];

    public InMemoryProductRepository(IEnumerable<Product> items)
    {
        _items = items.ToList();
    }

    public Task<(IReadOnlyList<Product> Items, long Total)> SearchAsync(SearchProductsInput input, CancellationToken ct = default)
    {
        var q = _items.AsEnumerable();

        if (!string.IsNullOrWhiteSpace(input.Query))
            q = q.Where(p => p.Name.Contains(input.Query, StringComparison.OrdinalIgnoreCase));

        var total = q.LongCount();
        var items = q.Skip((input.Page - 1) * input.Limit).Take(input.Limit).ToList();

        return Task.FromResult(((IReadOnlyList<Product>)items, total));
    }
}