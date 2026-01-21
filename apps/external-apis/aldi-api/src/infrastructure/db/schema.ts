import { boolean, text, timestamp, uuid, varchar } from "drizzle-orm/pg-core";
import { pgTable } from "drizzle-orm/pg-core";

export const products = pgTable('products', {
    id: uuid('id').primaryKey(),
    title: varchar('title', {length: 255}).notNull(),
    description: text('description').notNull(),
    category: varchar('category', {length: 255}).notNull(),
    price: varchar('price', {length: 255}).notNull(),
    image: varchar('image', {length: 255}).notNull(),
    currency: varchar('currency', {length: 255}).notNull(),
    brand: varchar('brand', {length: 255}).notNull(),
    inStock: boolean('in_stock').notNull().default(true),
    createdAt: timestamp('created_at').notNull().defaultNow(),
    updatedAt: timestamp('updated_at').notNull().defaultNow(),
})