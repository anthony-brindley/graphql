<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Book;
use App\Models\Category;

final readonly class TotalBooksCount
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        // Check if categoryId is provided
        if (isset($args['categoryId'])) {
            // Ensure the category exists
            $category = Category::find($args['categoryId']);
            if ($category) {
                // Return the count of books in the category
                return $category->books()->count();
            } else {
                // Return 0 if the category does not exist
                return 0;
            }
        }
        
        return Book::count();
    }
}
