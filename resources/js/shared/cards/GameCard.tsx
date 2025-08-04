import BaseCard from './BaseCard';

type GameCardProps = {
  game: App.Data.Game.GameData;
  hasWidth?: boolean;
};

export default function GameCard({ game, hasWidth = false }: GameCardProps) {
  const href = `/games/${game.slug}`;

  return (
    <BaseCard
      data={{ ...game, image: { id: 1, original_url: game.image } }}
      href={href}
      hasWidth={hasWidth}
    />
  );
}
