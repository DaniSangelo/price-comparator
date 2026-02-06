using Lidl.Application.UseCases.SearchProducts;
using Microsoft.AspNetCore.Mvc;

namespace Lidl.Api.Controllers;

[ApiController]
[Route("api/{controller}")]
public sealed class ProductsController : Controller
{
    private readonly SearchProductsUseCase _useCase;

    public ProductsController(SearchProductsUseCase useCase)
    {
        _useCase = useCase;
    }

    [HttpGet]
    public async Task<IActionResult> Search(
        [FromQuery] string? query,
        [FromQuery] int page = 1,
        [FromQuery] int limit = 20
    )
    {
        var input = new SearchProductsInput(
            query,
            page,
            limit
        );

        var output = await _useCase.ExecuteAsync(input, HttpContext.RequestAborted);
        return Ok(output);
    }
}