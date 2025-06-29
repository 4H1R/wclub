<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $link
 * @property int|null $order_column
 * @property string|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Media|null $image
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \App\Models\Media> $media
 * @property-read int|null $media_count
 * @method static \Database\Factories\BannerFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereOrderColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperBanner {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $model
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\CategoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperCategory {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $full_name
 * @property string|null $email
 * @property string $phone
 * @property string $title
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $is_read
 * @method static \Database\Factories\ContactUsFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactUs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactUs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactUs query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactUs whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactUs whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactUs whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactUs whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactUs whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactUs wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactUs whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactUs whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperContactUs {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $short_description
 * @property string $description
 * @property int|null $min_participants
 * @property int|null $max_participants
 * @property string $started_at
 * @property string $finished_at
 * @property string|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read \App\Models\Media|null $image
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \App\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $registrations
 * @property-read int|null $registrations_count
 * @property-read mixed $slug
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TargetGroup> $targetGroups
 * @property-read int|null $target_groups_count
 * @method static \Database\Factories\ContestFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contest query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contest whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contest whereFinishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contest whereMaxParticipants($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contest whereMinParticipants($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contest wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contest whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contest whereStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contest whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contest whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperContest {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $title
 * @property string $code
 * @property \App\Enums\Coupon\CouponTypeEnum $type
 * @property int|null $amount
 * @property int|null $percentage
 * @property int|null $max_percentage_amount
 * @property \Illuminate\Support\Carbon $expired_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\CouponFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereMaxPercentageAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon wherePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperCoupon {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $payment_type
 * @property string $title
 * @property string $short_description
 * @property string $description
 * @property int|null $price
 * @property int|null $previous_price
 * @property int|null $min_participants
 * @property int|null $max_participants
 * @property string $started_at
 * @property string $finished_at
 * @property string|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Faq> $faqs
 * @property-read int|null $faqs_count
 * @property-read \App\Models\Media|null $image
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \App\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read mixed $slug
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TargetGroup> $targetGroups
 * @property-read int|null $target_groups_count
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\EventProgramFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventProgram newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventProgram newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventProgram query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventProgram whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventProgram whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventProgram whereFinishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventProgram whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventProgram whereMaxParticipants($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventProgram whereMinParticipants($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventProgram wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventProgram wherePreviousPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventProgram wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventProgram wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventProgram whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventProgram whereStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventProgram whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventProgram whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventProgram whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperEventProgram {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property \App\Enums\Faq\FaqStatusEnum $status
 * @property int $user_id
 * @property string $model_type
 * @property int $model_id
 * @property string $question
 * @property string|null $answer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $model
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\FaqFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperFaq {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $slug
 * @property string|null $image
 * @property string|null $image_type
 * @property string|null $short_description
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Game newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Game newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Game query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Game whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Game whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Game whereImageType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Game whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Game whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Game whereTitle($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperGame {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $address
 * @property float|null $latitude
 * @property float|null $longitude
 * @property int $max_participants
 * @property string|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Media|null $image
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \App\Models\Media> $images
 * @property-read int|null $images_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \App\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read mixed $slug
 * @method static \Database\Factories\GardenFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Garden newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Garden newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Garden query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Garden whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Garden whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Garden whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Garden whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Garden whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Garden whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Garden whereMaxParticipants($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Garden wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Garden whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Garden whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperGarden {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Media|null $image
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \App\Models\Media> $media
 * @property-read int|null $media_count
 * @method static \Database\Factories\HnImageFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HnImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HnImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HnImage query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HnImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HnImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HnImage wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HnImage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HnImage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperHnImage {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $text
 * @property string $author
 * @property string|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\HnTextFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HnText newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HnText newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HnText query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HnText whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HnText whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HnText whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HnText wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HnText whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HnText whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperHnText {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $model_type
 * @property int $model_id
 * @property string|null $uuid
 * @property string $collection_name
 * @property string $name
 * @property string $file_name
 * @property string|null $mime_type
 * @property string $disk
 * @property string|null $conversions_disk
 * @property int $size
 * @property array<array-key, mixed> $manipulations
 * @property array<array-key, mixed> $custom_properties
 * @property array<array-key, mixed> $generated_conversions
 * @property array<array-key, mixed> $responsive_images
 * @property int|null $order_column
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $extension
 * @property-read mixed $human_readable_size
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $model
 * @property-read mixed $original_url
 * @property-read mixed $preview_url
 * @property-read mixed $type
 * @method static \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, static> all($columns = ['*'])
 * @method static \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, static> get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media ordered()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereCollectionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereConversionsDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereCustomProperties($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereGeneratedConversions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereManipulations($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereOrderColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereResponsiveImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereUuid($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperMedia {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $short_description
 * @property string $description
 * @property string|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read \App\Models\Media|null $image
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \App\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read mixed $slug
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TargetGroup> $targetGroups
 * @property-read int|null $target_groups_count
 * @method static \Database\Factories\NewsFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperNews {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $coupon_id
 * @property \App\Enums\Order\OrderStatusEnum $status
 * @property \App\Enums\Order\OrderPaymentStatusEnum $payment_status
 * @property int $total_amount
 * @property int $coupon_amount
 * @property int $paying_amount
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Coupon|null $coupon
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrderItem> $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Transaction> $transactions
 * @property-read int|null $transactions_count
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\OrderFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereCouponAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereCouponId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order wherePayingAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperOrder {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $order_id
 * @property string $model_type
 * @property int $model_id
 * @property int $price
 * @property int $quantity
 * @property int $subtotal
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $model
 * @property-read \App\Models\Order $order
 * @method static \Database\Factories\OrderItemFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereSubtotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperOrderItem {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission withoutRole($roles, $guard = null)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperPermission {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $short_description
 * @property string $description
 * @property int $required_score
 * @property int|null $min_participants
 * @property int|null $max_participants
 * @property string|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read \App\Models\Media|null $image
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \App\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read mixed $slug
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TargetGroup> $targetGroups
 * @property-read int|null $target_groups_count
 * @method static \Database\Factories\RewardProgramFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RewardProgram newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RewardProgram newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RewardProgram query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RewardProgram whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RewardProgram whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RewardProgram whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RewardProgram whereMaxParticipants($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RewardProgram whereMinParticipants($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RewardProgram wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RewardProgram whereRequiredScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RewardProgram whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RewardProgram whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RewardProgram whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperRewardProgram {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role withoutPermission($permissions)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperRole {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property \App\Enums\Series\SeriesStatusEnum $status
 * @property \App\Enums\PaymentTypeEnum $payment_type
 * @property \App\Enums\Series\SeriesPresentationModeEnum $presentation_mode
 * @property string $title
 * @property string $short_description
 * @property string $description
 * @property int|null $price
 * @property int|null $previous_price
 * @property array<array-key, mixed>|null $faqs_array
 * @property int $episodes_duration_seconds
 * @property string|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SeriesChapter> $chapters
 * @property-read int|null $chapters_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SeriesEpisode> $episodes
 * @property-read int|null $episodes_count
 * @property-read \App\Models\Media|null $image
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \App\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $ownedUsers
 * @property-read int|null $owned_users_count
 * @property-read mixed $slug
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TargetGroup> $targetGroups
 * @property-read int|null $target_groups_count
 * @method static \Database\Factories\SeriesFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Series newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Series newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Series query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Series whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Series whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Series whereEpisodesDurationSeconds($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Series whereFaqsArray($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Series whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Series wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Series wherePresentationMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Series wherePreviousPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Series wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Series wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Series whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Series whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Series whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Series whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperSeries {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $series_id
 * @property string $title
 * @property int|null $order_column
 * @property string|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SeriesEpisode> $episodes
 * @property-read int|null $episodes_count
 * @property-read \App\Models\Series $series
 * @property-read mixed $slug
 * @method static \Database\Factories\SeriesChapterFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SeriesChapter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SeriesChapter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SeriesChapter ordered(string $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SeriesChapter query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SeriesChapter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SeriesChapter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SeriesChapter whereOrderColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SeriesChapter wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SeriesChapter whereSeriesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SeriesChapter whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SeriesChapter whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperSeriesChapter {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $chapter_id
 * @property int $series_id
 * @property string $title
 * @property string|null $description
 * @property int $video_duration_seconds
 * @property int $watch_score
 * @property int|null $order_column
 * @property string|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \App\Models\Media> $attachments
 * @property-read int|null $attachments_count
 * @property-read \App\Models\SeriesChapter|null $chapter
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \App\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Models\Series $series
 * @property-read \App\Models\Media|null $video
 * @method static \Database\Factories\SeriesEpisodeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SeriesEpisode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SeriesEpisode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SeriesEpisode ordered(string $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SeriesEpisode query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SeriesEpisode whereChapterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SeriesEpisode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SeriesEpisode whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SeriesEpisode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SeriesEpisode whereOrderColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SeriesEpisode wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SeriesEpisode whereSeriesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SeriesEpisode whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SeriesEpisode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SeriesEpisode whereVideoDurationSeconds($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SeriesEpisode whereWatchScore($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperSeriesEpisode {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property int $min_age
 * @property int $max_age
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Media|null $image
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \App\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read mixed $slug
 * @method static \Database\Factories\TargetGroupFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TargetGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TargetGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TargetGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TargetGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TargetGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TargetGroup whereMaxAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TargetGroup whereMinAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TargetGroup whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TargetGroup whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperTargetGroup {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $order_id
 * @property \App\Enums\Transaction\TransactionStatusEnum $status
 * @property \App\Enums\Transaction\TransactionGatewayNameEnum $gateway_name
 * @property int $amount
 * @property string|null $ref_id
 * @property string|null $token
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Order|null $order
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\TransactionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereGatewayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereRefId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperTransaction {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property string|null $email
 * @property string $birth_date
 * @property int $score
 * @property \Illuminate\Support\Carbon|null $phone_verified_at
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $age
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contest> $contestRegistrations
 * @property-read int|null $contest_registrations_count
 * @property-read mixed $full_name
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Series> $ownedSeries
 * @property-read int|null $owned_series_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $safeRoles
 * @property-read int|null $safe_roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserScoreLog> $scoreLogs
 * @property-read int|null $score_logs_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhoneVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutRole($roles, $guard = null)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperUser {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $score
 * @property string $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\UserScoreLogFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserScoreLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserScoreLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserScoreLog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserScoreLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserScoreLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserScoreLog whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserScoreLog whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserScoreLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserScoreLog whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperUserScoreLog {}
}

