FROM mcr.microsoft.com/dotnet/sdk:8.0 AS build
WORKDIR /src

COPY apps/external-apis/lidl-api/src/Lidl.Api/Lidl.Api.csproj apps/external-apis/lidl-api/src/Lidl.Api/
COPY apps/external-apis/lidl-api/src/Lidl.Application/Lidl.Application.csproj apps/external-apis/lidl-api/src/Lidl.Application/
COPY apps/external-apis/lidl-api/src/Lidl.Domain/Lidl.Domain.csproj apps/external-apis/lidl-api/src/Lidl.Domain/
COPY apps/external-apis/lidl-api/src/Lidl.Infrastructure/Lidl.Infrastructure.csproj apps/external-apis/lidl-api/src/Lidl.Infrastructure/

RUN dotnet restore apps/external-apis/lidl-api/src/Lidl.Api/Lidl.Api.csproj

COPY apps/external-apis/lidl-api/src ./apps/external-apis/lidl-api/src

RUN dotnet publish apps/external-apis/lidl-api/src/Lidl.Api/Lidl.Api.csproj \
    -c Release -o /app/publish

FROM mcr.microsoft.com/dotnet/aspnet:8.0
WORKDIR /app
COPY --from=build /app/publish .
EXPOSE 8080
ENTRYPOINT ["dotnet", "Lidl.Api.dll"]
