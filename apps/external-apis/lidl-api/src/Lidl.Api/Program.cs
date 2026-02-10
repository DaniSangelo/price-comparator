using Lidl.Application.Ports;
using Lidl.Application.UseCases.SearchProducts;
using Lidl.Infrastructure;
using Lidl.Infrastructure.Data;
using Lidl.Infrastructure.Repositories.Ef;
using Microsoft.EntityFrameworkCore;

var builder = WebApplication.CreateBuilder(args);

// Add services to the container.

builder.Services.AddControllers();
builder.Logging.ClearProviders();
builder.Logging.AddJsonConsole();

builder.Services.AddControllers();

builder.Services.AddDbContext<LidlDbContext>(options =>
    options.UseSqlServer(
        builder.Configuration.GetConnectionString("Default")
    )
);

builder.Services.AddHealthChecks();

builder.Services.AddScoped<IProductRepository, ProductRepository>();
builder.Services.AddScoped<SearchProductsUseCase>();

var app = builder.Build();

using (var scope = app.Services.CreateScope())
{
    var services = scope.ServiceProvider;
    try
    {
        var context = services.GetRequiredService<LidlDbContext>();
        context.Database.Migrate(); 
        
        DbInitializer.Seed(context);
    }
    catch (Exception ex)
    {
        var logger = services.GetRequiredService<ILogger<Program>>();
        logger.LogError(ex, "Ocorreu um erro ao popular o banco de dados.");
    }
}

// Configure the HTTP request pipeline.

app.UseHttpsRedirection();

app.UseAuthorization();

app.MapHealthChecks("/health");
app.MapControllers();

app.Run();
