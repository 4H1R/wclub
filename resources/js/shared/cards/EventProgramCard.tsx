import { cn, slugifyId } from '@/utils';
import { Link } from '@inertiajs/react';
import { GoDotFill } from 'react-icons/go';
import Image from '../images/Image';

type EventProgramCardProps = {
  eventProgram: App.Data.EventProgram.EventProgramData;
};

export default function EventProgramCard({ eventProgram }: EventProgramCardProps) {
  const href = route('event-programs.show', [slugifyId(eventProgram.id, eventProgram.title)]);

  return (
    <div className="card h-full bg-base-100 shadow">
      <Link href={href}>
        <figure className="h-44 w-full bg-base-200">
          {eventProgram.image && (
            <Image
              className="size-full"
              src={eventProgram.image?.original_url}
              alt={eventProgram.title}
            />
          )}
        </figure>
      </Link>
      <div className="card-body">
        <div className={cn('flex items-center gap-1 text-base-content/80', {})}>
          <GoDotFill className="size-2" />
          <span className="text-xs font-bold">تمام شده</span>
        </div>
        <h2 className="card-title">{eventProgram.title}</h2>
        {eventProgram.short_description && (
          <p className="max-h-fit text-sm text-base-content/80">{eventProgram.short_description}</p>
        )}
        {eventProgram.categories.length > 0 && (
          <div className="flex flex-wrap items-center gap-1 pb-6 pt-2">
            {eventProgram.categories.map((category) => (
              <span key={category.id} className="badge badge-md bg-base-200">
                {category.title}
              </span>
            ))}
          </div>
        )}
        <Link className="btn md:mt-auto" href={href}>
          اطلاعات بیشتر
        </Link>
      </div>
    </div>
  );
}
