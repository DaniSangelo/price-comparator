import crypto from "node:crypto";
import { db } from "./drizzle";
import { products } from "./schema";
import dotenv from "dotenv";
dotenv.config();

async function main() {
    if (process.env.NODE_ENV !== 'development') {
        return;
    }

    const seedProducts = [
        // --- ALIMENTOS DISPENSA ---
        {
            id: crypto.randomUUID(),
            title: "Arroz Agulhinha Tipo 1 5kg",
            description: "Arroz de alta qualidade, grãos selecionados e soltinhos.",
            category: "Mercearia",
            price: "29.90",
            image: "https://images.unsplash.com/photo-1586201375761-83865001e31c",
            currency: "BRL",
            brand: "Tio João",
            inStock: true,
            createdAt: new Date(),
            updatedAt: new Date(),
        },
        {
            id: crypto.randomUUID(),
            title: "Feijão Carioca 1kg",
            description: "Feijão novo, de cozimento rápido e caldo grosso.",
            category: "Mercearia",
            price: "8.50",
            image: "https://images.unsplash.com/photo-1551462147-37885acc3c44",
            currency: "BRL",
            brand: "Camil",
            inStock: true,
            createdAt: new Date(),
            updatedAt: new Date(),
        },
        {
            id: crypto.randomUUID(),
            title: "Macarrão Espaguete n°8 500g",
            description: "Massa com ovos, ideal para molhos vermelhos.",
            category: "Massas",
            price: "4.20",
            image: "https://images.unsplash.com/photo-1551462147-ff178229f122",
            currency: "BRL",
            brand: "Barilla",
            inStock: true,
            createdAt: new Date(),
            updatedAt: new Date(),
        },
        {
            id: crypto.randomUUID(),
            title: "Café Torrado e Moído 500g",
            description: "Sabor intenso e aroma preservado em embalagem a vácuo.",
            category: "Matinais",
            price: "18.90",
            image: "https://images.unsplash.com/photo-1559056199-641a0ac8b55e",
            currency: "BRL",
            brand: "Pilão",
            inStock: true,
            createdAt: new Date(),
            updatedAt: new Date(),
        },

        // --- LIMPEZA ---
        {
            id: crypto.randomUUID(),
            title: "Detergente Líquido Neutro 500ml",
            description: "Eficiente na gordura e suave nas mãos.",
            category: "Limpeza",
            price: "2.45",
            image: "https://images.unsplash.com/photo-1563453392212-326f5e854473",
            currency: "BRL",
            brand: "Ipê",
            inStock: true,
            createdAt: new Date(),
            updatedAt: new Date(),
        },
        {
            id: crypto.randomUUID(),
            title: "Amaciante Concentrado Toque de Luxo 1.5L",
            description: "Rende até 60 lavagens com perfume duradouro.",
            category: "Limpeza",
            price: "22.00",
            image: "https://images.unsplash.com/photo-1610557892470-55d9e80c0bce",
            currency: "BRL",
            brand: "Downy",
            inStock: true,
            createdAt: new Date(),
            updatedAt: new Date(),
        },

        // --- HIGIENE ---
        {
            id: crypto.randomUUID(),
            title: "Creme Dental Proteção Total 90g",
            description: "Hálito fresco e proteção contra cáries.",
            category: "Higiene",
            price: "5.99",
            image: "https://images.unsplash.com/photo-1559594412-290076a91642",
            currency: "BRL",
            brand: "Colgate",
            inStock: true,
            createdAt: new Date(),
            updatedAt: new Date(),
        },
        {
            id: crypto.randomUUID(),
            title: "Sabonete em Barra Original 90g",
            description: "Com 1/4 de creme hidratante.",
            category: "Higiene",
            price: "4.50",
            image: "https://images.unsplash.com/photo-1600857062241-98e5dba7f214",
            currency: "BRL",
            brand: "Dove",
            inStock: true,
            createdAt: new Date(),
            updatedAt: new Date(),
        }
    ];

    const supermarketData = [
        { cat: 'Bebidas', brands: ['Coca-Cola', 'Ambev', 'Heineken', 'Nestlé', 'Red Bull'], items: ['Refrigerante', 'Cerveja', 'Água Mineral', 'Suco de Uva', 'Energético'] },
        { cat: 'Laticínios', brands: ['Itambé', 'Vigor', 'Danone', 'Polenguinho', 'Nestlé'], items: ['Leite Integral', 'Iogurte Grego', 'Queijo Prato', 'Requeijão Cremoso', 'Manteiga com Sal'] },
        { cat: 'Biscoitos e Snacks', brands: ['Piraquê', 'Mabel', 'Elma Chips', 'Oreo', 'Kellogg\'s'], items: ['Biscoito Recheado', 'Salgadinho de Milho', 'Batata Chips', 'Cookies de Chocolate', 'Cereal Matinal'] },
        { cat: 'Carnes e Frios', brands: ['Sadia', 'Perdigão', 'Seara', 'Friboi'], items: ['Presunto Cozido', 'Peito de Peru', 'Salsicha Hot Dog', 'Picanha Fatiada', 'Frango Inteiro'] }
    ];

    for (let i = 0; i < 592; i++) {
        const section = supermarketData[i % supermarketData.length];
        const brand = section.brands[i % section.brands.length];
        const item = section.items[Math.floor(Math.random() * section.items.length)];
        const weight = (Math.random() * 1000).toFixed(0);

        seedProducts.push({
            id: crypto.randomUUID(),
            title: `${brand} - ${item} ${weight}g/ml`,
            description: `Produto de alta qualidade da linha ${brand}, categoria ${section.cat}. Ideal para o consumo diário da sua família.`,
            category: section.cat,
            price: (Math.random() * (45 - 3) + 3).toFixed(2),
            image: `https://picsum.photos/seed/product${i}/400/400`,
            currency: "BRL",
            brand: brand,
            inStock: true,
            createdAt: new Date(),
            updatedAt: new Date()
        });
    }

    console.log("🌱 Seeding products...", process.env.DATABASE_URL);

    // await db.delete(products);
    await db.insert(products).values(seedProducts);

    console.log(`✅ Seed completed: ${seedProducts.length} products inserted`);
    process.exit(0);
}

main().catch((err) => {
  console.error("❌ Seed failed:", err);
  console.error("DETAILS: ", err?.errors ?? err.cause ?? err?.message ?? err)
  process.exit(1);
});