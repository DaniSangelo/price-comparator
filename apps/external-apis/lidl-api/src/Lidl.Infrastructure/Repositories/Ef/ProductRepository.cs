using Lidl.Application.Ports;
using Lidl.Application.UseCases.SearchProducts;
using Lidl.Domain.Entities;
using Lidl.Infrastructure.Data;
using Microsoft.EntityFrameworkCore;

namespace Lidl.Infrastructure.Repositories.Ef;

public sealed class ProductRepository : IProductRepository
{
    private readonly LidlDbContext _dbContext;
    public ProductRepository(LidlDbContext dbContext) => _dbContext = dbContext;

    public async Task<(IReadOnlyList<Product> Items, long Total)> SearchAsync(SearchProductsInput input, CancellationToken ct = default)
    {
        var q = _dbContext.Products.AsNoTracking();

        if(!string.IsNullOrEmpty(input.Query))
        {
            q = q.Where(p => p.Name.Contains(input.Query) || p.Description.Contains(input.Query));
        }

        var total = await q.LongCountAsync(ct);
        var items = await q.OrderBy(p => p.Name)
            .Skip((input.Page - 1) * input.Limit)
            .Take(input.Limit)
            .ToListAsync(ct);

        return (items, total);
    }
}