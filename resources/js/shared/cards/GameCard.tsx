import { cn } from '@/utils';
import { Link } from '@inertiajs/react';
import Image from '../images/Image';

type GameCardProps = {
  game: App.Data.Game.GameData;
  hasWidth?: boolean;
  className?: string;
};

export default function GameCard({ game, className, hasWidth = false }: GameCardProps) {
  const href = `/games/${game.slug}`;

  return (
    <div className={cn('card h-full bg-base-100 shadow', { 'w-[20rem]': hasWidth }, className)}>
      <Link href={href}>
        <figure className="h-44 w-full bg-base-200 lg:h-56">
          <Image className="size-full object-contain" src={game.image} alt={game.title} />
        </figure>
      </Link>
      <div className="card-body h-full">
        <h2 className="card-title">{game.title}</h2>
        <p className="line-clamp-4 max-h-fit text-sm text-base-content/80">
          {game.short_description}
        </p>
        <Link className="btn mt-auto" href={href}>
          <span>اطلاعات بیشتر</span>
        </Link>
      </div>
    </div>
  );
}
