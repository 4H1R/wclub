import SharedCardProperties from '@/components/cards/SharedCardProperties';
import { eventProgramStatusTranslation } from '@/enums';
import { slugifyId } from '@/utils';
import { GoDotFill } from 'react-icons/go';
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
      bodyStartChildren={
        <div className="flex items-center gap-1">
          <GoDotFill className="size-2" />
          <span className="text-xs font-bold">
            {eventProgramStatusTranslation[eventProgram.status]}
          </span>
        </div>
      }
      bodyEndChildren={
        <SharedCardProperties
          categories={eventProgram.categories}
          targetGroups={eventProgram.target_groups}
        />
      }
    />
  );
}
