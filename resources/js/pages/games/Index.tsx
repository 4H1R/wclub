import { PageProps } from '@/@types';
import Head from '@/shared/Head';
import GameCard from '@/shared/cards/GameCard';
import { usePage } from '@inertiajs/react';

type TPage = PageProps<{
  games: App.Data.Game.GameData[];
}>;

export default function Index() {
  const { games } = usePage<TPage>().props;

  return (
    <div className="space-y mt-page container">
      <Head canonicalUrl={route('games.index')} title="بازی ها" description="بازی ها" />
      <h1 className="h1">بازی ها</h1>
      <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        {games.map((game) => (
          <GameCard key={game.slug} game={game} />
        ))}
      </div>
    </div>
  );
}
