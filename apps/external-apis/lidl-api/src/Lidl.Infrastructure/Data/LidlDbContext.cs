using Lidl.Domain.Entities;
using Microsoft.EntityFrameworkCore;

namespace Lidl.Infrastructure.Data;

public sealed class LidlDbContext : DbContext
{
    public LidlDbContext(DbContextOptions<LidlDbContext> options) : base(options) {}
    public DbSet<Product> Products => Set<Product>();

    protected override void OnModelCreating(ModelBuilder modelBuilder)
    {
        modelBuilder.Entity<Product>(entity =>
        {
            entity.ToTable("products");
            entity.HasKey(p => p.Id);
            entity.Property(p => p.Id).ValueGeneratedNever();
            entity.Property(p => p.Name).HasMaxLength(255).IsRequired();
            entity.Property(p => p.Description).HasMaxLength(255).IsRequired();
            entity.Property(p => p.Category).HasMaxLength(255).IsRequired();
            entity.Property(p => p.Price).HasPrecision(10, 2).IsRequired();
            entity.Property(p => p.Currency).HasMaxLength(3).IsRequired();
            entity.Property(p => p.InStock).IsRequired();
            entity.Property(p => p.Brand).HasMaxLength(255);
            entity.Property(p => p.Image).HasMaxLength(255);
            entity.Property(p => p.CreatedAt).IsRequired().HasDefaultValueSql("GETDATE()");
            entity.Property(p => p.UpdatedAt).IsRequired().HasDefaultValueSql("GETDATE()");
        });
    }
}