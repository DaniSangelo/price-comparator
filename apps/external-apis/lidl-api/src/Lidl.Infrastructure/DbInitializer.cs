namespace Lidl.Infrastructure;

using Bogus;
using Lidl.Domain.Entities;
using Lidl.Infrastructure.Data;

public static class DbInitializer
{
    public static void Seed(LidlDbContext context)
    {
        if (context.Products.Any()) return;

        var productFaker = new Faker<Product>("pt_BR")
            .RuleFor(p => p.Id, f => Guid.NewGuid())
            .RuleFor(p => p.Name, f => f.Commerce.ProductName())
            .RuleFor(p => p.Description, f => f.Commerce.ProductDescription())
            .RuleFor(p => p.Category, f => f.Commerce.Categories(1)[0])
            .RuleFor(p => p.Price, f => decimal.Parse(f.Commerce.Price(1, 100)))
            .RuleFor(p => p.Currency, f => "EUR")
            .RuleFor(p => p.InStock, f => f.Random.Bool(0.8f))
            .RuleFor(p => p.Brand, f => f.Company.CompanyName())
            .RuleFor(p => p.Image, f => f.Image.PicsumUrl())
            .RuleFor(p => p.CreatedAt, f => f.Date.Past(1))
            .RuleFor(p => p.UpdatedAt, f => DateTime.UtcNow);

        var products = productFaker.Generate(100);

        context.Products.AddRange(products);
        context.SaveChanges();
    }
}