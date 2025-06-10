import { slugifyId } from '@/utils';
import BaseCard from './BaseCard';

type GardenCardProps = {
  garden: App.Data.Garden.GardenData;
  hasWidth?: boolean;
};

export default function GardenCard({ garden, hasWidth = false }: GardenCardProps) {
  const href = route('gardens.show', [slugifyId(garden.id, garden.title)]);

  return (
    <BaseCard
      data={{ ...garden, short_description: garden.address }}
      href={href}
      hasWidth={hasWidth}
    />
  );
}
