CREATE TABLE "products" (
	"id" uuid PRIMARY KEY NOT NULL,
	"title" varchar(255) NOT NULL,
	"description" text NOT NULL,
	"category" varchar(255) NOT NULL,
	"price" varchar(255) NOT NULL,
	"image" varchar(255) NOT NULL,
	"currency" varchar(255) NOT NULL,
	"brand" varchar(255) NOT NULL,
	"in_stock" boolean DEFAULT true NOT NULL,
	"created_at" timestamp DEFAULT now() NOT NULL,
	"updated_at" timestamp DEFAULT now() NOT NULL
);
