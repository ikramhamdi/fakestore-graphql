# Fakestore GraphQL API (Laravel)

This is a simple Laravel-based GraphQL API integration project that fetches product data from [FakeStoreAPI](https://fakestoreapi.com/) and exposes it via a custom GraphQL endpoint. This project was built as part of a showcase for integration developer roles.

---

## 📦 Features

- 📡 Fetch product data from an external public API.
- ⚙️ Custom GraphQL query implementation using `rebing/graphql-laravel` package.
- 📑 Supports pagination via query arguments (`page` and `limit`).
- 🔍 Custom `PageInfo` type for paginated metadata.
- 🔒 CORS middleware enabled for frontend integration.
- 📖 Well-organized API service class for external API requests.

---

## 📌 Tech Stack

- PHP 8+
- Laravel 10+
- GraphQL via `rebing/graphql-laravel`
- HTTP client via Laravel `Http` facade

---

## 🚀 Getting Started

### 1️⃣ Clone the repository

```bash
git clone https://github.com/ikramhamdi/fakestore-graphql.git
cd fakestore-graphql
