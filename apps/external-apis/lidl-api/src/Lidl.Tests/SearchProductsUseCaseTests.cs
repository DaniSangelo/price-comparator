using Lidl.Application.UseCases.SearchProducts;
using Lidl.Domain.Entities;
using Lidl.Infrastructure.Repositories.InMemory;
using Microsoft.Extensions.Logging.Abstractions;
using Xunit;

public class SearchProductsUseCaseTests
{
    [Fact]
    public async Task Should_return_filtered_products()
    {
        var repo = new InMemoryProductRepository(new[]
        {
            new Product { Id = Guid.NewGuid(), Name = "Milk 1L", Description = "Nice", Category = "Dairy", Price = 2.5m, Image="x", Brand="Lidl", Currency="EUR", InStock=true, CreatedAt=DateTime.UtcNow, UpdatedAt=DateTime.UtcNow },
            new Product { Id = Guid.NewGuid(), Name = "Chocolate", Description = "Sweet", Category = "Snacks", Price = 1.2m, Image="x", Brand="Lidl", Currency="EUR", InStock=true, CreatedAt=DateTime.UtcNow, UpdatedAt=DateTime.UtcNow },
        });

        var useCase = new SearchProductsUseCase(repo, NullLogger<SearchProductsUseCase>.Instance);

        var output = await useCase.ExecuteAsync(new SearchProductsInput("milk", 1, 20), CancellationToken.None);

        Assert.Single(output.Items);
        Assert.Equal("Milk 1L", output.Items[0].Name);
    }
}
