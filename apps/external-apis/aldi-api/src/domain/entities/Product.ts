export type Product = {
    id: string;
    title: string;
    description: string;
    category: string;
    price: string; //just to be different from continent-api which price is float
    image: string;
    currency: string;
    brand: string;
    inStock: boolean;
    createdAt: Date;
    updatedAt: Date;
}