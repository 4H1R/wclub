import SharedCardProperties from '@/components/cards/SharedCardProperties';
import { slugifyId } from '@/utils';
import BaseCard from './BaseCard';

type EventProgramCardProps = {
  eventProgram: App.Data.EventProgram.EventProgramData;
  hasWidth?: boolean;
};

export default function EventProgramCard({
  eventProgram,
  hasWidth = false,
}: EventProgramCardProps) {
  const href = route('event-programs.show', [slugifyId(eventProgram.id, eventProgram.title)]);

  return (
    <BaseCard
      data={eventProgram}
      href={href}
      hasWidth={hasWidth}
      bodyEndChildren={
        <SharedCardProperties
          categories={eventProgram.categories}
          targetGroups={eventProgram.target_groups}
        />
      }
    />
  );
}
