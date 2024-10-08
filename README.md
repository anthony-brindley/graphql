# GraphQL Implementation with Laravel 

## Summary

This application was a research project designed to help me understand better how GraphQL can be implemented with Laravel. It provided me a great opportunity to work with GraphQL queries as well as working with the actual implementation details within Laravel. 

## Concept

I created a very basic book/category setup (akin to a library I suppose). I was able to then use this setup to implement some common user behaviours such as: 

- create a book or category
- get the record for a book or category using it's uuid
- update a book's title/author
- attach a book to a category
- remove a book from a category
- update a category
- delete a book or catgeory
- get total book count
- get the number of books assigned to a particular category

# TODO: Pagination
# TODO: Add Author model so I am forced to refactor


### How to use the Demo

1. Install the demo locally on a PHP server that allows access to the application from the browser. 
1. Run `php artisan migrate --seed` to populate your database (I will assume you can setup the database etc) 
1. Navigate to the `/graphiql` url of your local codebase in the browser
1. You are then able to make queries to the application using GraphQL syntax (examples below)


### Query Examples

1. Show the complete list of books including the id and name of it's associated Categories

```GraphQL

{
  books {
    id
    title
    categories {
      id
      name
    }
  }
}
```

2. Get a complete list of Categories within the system

```GraphQL
{
    categories {
        id
        name
    }
}
```

3. Get a specific book by it's ID and return a data structure that includes its categories and their IDs and names

```GraphQL
{
    book(id: "{book uuid here}") {
        id
        title
        author
        categories {
            id
            name
        }
    }
}
```

4. Search the database for books containing specific text in the title

```GraphQL

{
    booksByPartialTitle(search: {string}){
        id
        title
        author
        categories {
            id
            name
        }
    }
}

```

5. Get the total books count or the count of books assigned to a particular category

```GraphQL
# total books in db count
{
    totalBooksCount
}

# total books in category
{
    totalBooksCount(categoryId: "{category uuid here}")
}
```

5. Assign a book to a particular category by the category name

```GraphQL
mutation {
    assignBookCategoryByName(
        bookId: "{book id here}"
        categoryName: "{category name (case sensitive)}"
    ) {
        id
        title
        author
        categories {
            id
            name
        }
    } 
}

```

6. Unassign a book from a particular category by the category name

```GraphQL
mutation {
    unassignBookCategoryByName(
        bookId: "{book id here}"
        categoryName: "{category name (case sensitive)}"
    ) {
        id
        title
        author
        categories {
            id
            name
        }
    } 
}

```

7. Update a book's details

```GraphQL

mutation {
    updateBook(id: "{book uuid}", title: "optional new title", author: "optional new author")
    {
        id
        title
        author
        categories {
            id
            name
        }
    }
}

```

8. Update category details

```GraphQL

mutation {
    updateCategory(id: "{category uuid}", name: "new name")
    {
        id
        name
    }
}
```

9. Delete a book

```GraphQL
mutation {
    deleteBook(id: "{book uuid}")
    {
        id
        title
        author
        categories {
            id
            name
        }
    }
}

```

10. Delete a category

```GraphQL
mutation {
    deleteCategory(id: "{category uuid}")
    {
        id
        name
    }
}

```

## Useful Resources

- [Lighthouse Documentation](https://lighthouse-php.com/)
- [Youtube Series](https://www.youtube.com/playlist?list=PLEhEHUEU3x5qsA5JnRzhgOghrH9Vqz4cg)
- [PHP wrapper for GraphQL docs](https://webonyx.github.io/graphql-php/)
