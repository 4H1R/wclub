import SharedCardProperties from '@/components/cards/SharedCardProperties';
import { cn, slugifyId } from '@/utils';
import { Link } from '@inertiajs/react';
import Image from '../images/Image';

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
    <div className={cn('card h-full bg-base-100 shadow', { 'w-[22rem]': hasWidth })}>
      <Link href={href}>
        <figure className="h-44 w-full bg-base-200 lg:h-56">
          {eventProgram.image && (
            <Image
              className="size-full"
              src={eventProgram.image?.original_url}
              alt={eventProgram.title}
            />
          )}
        </figure>
      </Link>
      <div className="card-body h-full">
        <h2 className="card-title">{eventProgram.title}</h2>
        <p className="line-clamp-4 max-h-fit text-sm text-base-content/80">
          {eventProgram.short_description}
        </p>
        <SharedCardProperties
          targetGroups={eventProgram.target_groups}
          categories={eventProgram.categories}
        />
      </div>
    </div>
  );
}
