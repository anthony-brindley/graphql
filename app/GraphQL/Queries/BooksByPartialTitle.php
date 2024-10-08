<?php declare(strict_types=1);

namespace App\GraphQL\Queries;
use App\Models\Book;

final readonly class BooksByPartialTitle
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        return Book::where('title', 'like', '%'.$args['search'].'%')->get();
    }
}
