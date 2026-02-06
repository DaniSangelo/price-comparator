namespace Lidl.Domain.Entities;

public sealed class Product
{
    public Guid Id { get; init;}
    public string Name { get; init; }
    public string Description { get; init; }
    public string Category { get; init; }
    public decimal Price { get; init; }
    public string Currency { get; init; }
    public bool InStock { get; init; }
    public string? Brand { get; init; }
    public string? Image { get; init; }
    public DateTime CreatedAt { get; init; }
    public DateTime UpdatedAt { get; init; }
}