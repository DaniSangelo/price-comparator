using Lidl.Domain.Entities;

namespace Lidl.Infrastructure.Repositories.InMemory;

public sealed class InMemoryProductRepository
{
    private readonly List<Product> _items;

    public InMemoryProductRepository(IEnumerable<Product> items)
    {
        _items = items.ToList();
    }

    public Task<(IReadOnlyList<Product> Items, long Total)> SearchAsync(
        string? query, int page, int limit, CancellationToken ct)
    {
        var q = _items.AsEnumerable();

        if (!string.IsNullOrWhiteSpace(query))
            q = q.Where(p => p.Name.Contains(query, StringComparison.OrdinalIgnoreCase));

        var total = q.LongCount();

        var items = q.Skip((page - 1) * limit).Take(limit).ToList();

        return Task.FromResult(((IReadOnlyList<Product>)items, total));
    }
}