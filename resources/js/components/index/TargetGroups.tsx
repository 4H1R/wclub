import Image from '@/shared/images/Image';

type TargetGroupsProps = {
  targetGroups: App.Data.TargetGroup.TargetGroupData[];
};

export default function TargetGroups({ targetGroups }: TargetGroupsProps) {
  if (targetGroups.length < 1) return null;

  return (
    <div className="grid grid-cols-1 gap-4 gap-y-10 py-8 sm:grid-cols-2 md:gap-y-14 lg:mx-auto lg:grid-cols-3 xl:w-[64rem]">
      {targetGroups.map((targetGroup) => (
        <div
          key={targetGroup.id}
          className="relative rounded-box border-2 border-black bg-primary py-4 pr-[10%] text-center text-xl font-medium text-gray-50 transition-transform hover:scale-105 md:py-8 md:pr-[23%] lg:min-w-[15.625rem] lg:text-2xl"
        >
          <span>{targetGroup.title}</span>
          {targetGroup.image && (
            <Image
              className="absolute -top-8 right-0 size-24 rounded-box md:-top-12 md:size-36"
              alt={targetGroup.title}
              src={targetGroup.image?.original_url}
            />
          )}
        </div>
      ))}
    </div>
  );
}
