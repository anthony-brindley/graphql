<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Book;
use App\Models\Category;
use GraphQL\Error\FormattedError;
use Illuminate\Database\Eloquent\Collection;
use InvalidArgumentException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

final readonly class AssignBookCategoryByName
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        $bookId = $args['bookId'];
        $categoryName = $args['categoryName'];


        if(!$bookId || !$categoryName)
        {
            FormattedError::createFromException(new InvalidArgumentException());
        }

        if(!($book = Book::find($bookId)) || !($category = Category::where('name', $categoryName)->first()))
        {
            FormattedError::createFromException(new ResourceNotFoundException());
        }


        if(!$book->categories()->where('category_id', $category->id)->exists())
        {
            $book->categories()->attach($category);
        }

        return $book->refresh();
    
    }
}
