<?php

namespace App\Filament\Widgets;

use App\Models\Child;
use App\Models\Education;
use App\Models\Family;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval='15s';
    protected static bool $isLazy=true;
    protected function getStats(): array
    {
        return [
            Stat::make('اجمالى الابناء',Child::count())
            ->description('اجمالى الابناء المقيدين فى جميع المراحل')
            ->descriptionIcon('heroicon-o-users')
            ->descriptionColor('info')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('info'),
            Stat::make('اجمالى العائلات',Family::count())
            ->description('اجمالى العائلات المقيدين')
            ->descriptionIcon('heroicon-o-user-group')
            ->descriptionColor('success')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('اجمالى المراحل التعليمية',Education::count())
            ->description('اجمالى المراحل التعليمية  ')
            ->descriptionIcon('heroicon-o-academic-cap')
            ->descriptionColor('gray')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('gray'),
//            Stat::make('سنة واحدة',Child::where('education_id','16')->count())
//            ->description('  من سن سنة واحدة')
//            ->descriptionIcon('heroicon-o-academic-cap')
//            ->descriptionColor('danger')
//                ->chart([7, 2, 10, 3, 15, 4, 17])
//                ->color('danger'),
//            Stat::make('سنتين',Child::where('education_id','17')->count())
//            ->description(' من سن سنتين')
//            ->descriptionIcon('heroicon-o-academic-cap')
//            ->descriptionColor('danger')
//                ->chart([7, 2, 10, 3, 15, 4, 17])
//                ->color('danger'),
//            Stat::make('ثلاث سنوات',Child::where('education_id','18')->count())
//            ->description(' من سن ثلاث سنوات ')
//            ->descriptionIcon('heroicon-o-academic-cap')
//            ->descriptionColor('danger')
//                ->chart([7, 2, 10, 3, 15, 4, 17])
//                ->color('danger'),
//            Stat::make(' حضانة',Child::where('education_id','1')->count())
//                ->description('اجمالى الاطفال المقيدين فى حضانة')
//                ->descriptionIcon('heroicon-o-users')
//                ->descriptionColor('success')
//                ->chart([7, 2, 10, 3, 15, 4, 17])
//                ->color('success'),
//            Stat::make(' الصف الاول الابتدائى',Child::where('education_id','2')->count())
//                ->description('اجمالى  المقيدين فى الصف الاول الابتدائى')
//                ->descriptionIcon('heroicon-o-users')
//                ->descriptionColor('success')
//                ->chart([7, 2, 10, 3, 15, 4, 17])
//                ->color('success'),
//            Stat::make(' الصف الثانى الابتدائى',Child::where('education_id','3')->count())
//                ->description('اجمالى  المقيدين فى الصف الثانى الابتدائى')
//                ->descriptionIcon('heroicon-o-users')
//                ->descriptionColor('success')
//                ->chart([7, 2, 10, 3, 15, 4, 17])
//                ->color('success'),
//            Stat::make(' الصف الثالث الابتدائى',Child::where('education_id','4')->count())
//                ->description('اجمالى  المقيدين فى الصف الثالث الابتدائى')
//                ->descriptionIcon('heroicon-o-users')
//                ->descriptionColor('success')
//                ->chart([7, 2, 10, 3, 15, 4, 17])
//                ->color('success'),
//            Stat::make(' الصف الرابع الابتدائى',Child::where('education_id','5')->count())
//                ->description('اجمالى  المقيدين فى الصف الرابع الابتدائى')
//                ->descriptionIcon('heroicon-o-users')
//                ->descriptionColor('success')
//                ->chart([7, 2, 10, 3, 15, 4, 17])
//                ->color('success'),
//            Stat::make(' الصف الخامس الابتدائى',Child::where('education_id','6')->count())
//                ->description('اجمالى  المقيدين فى الصف الخامس الابتدائى')
//                ->descriptionIcon('heroicon-o-users')
//                ->descriptionColor('success')
//                ->chart([7, 2, 10, 3, 15, 4, 17])
//                ->color('success'),
//            Stat::make(' الصف السادس الابتدائى',Child::where('education_id','7')->count())
//                ->description('اجمالى  المقيدين فى الصف السادس الابتدائى')
//                ->descriptionIcon('heroicon-o-users')
//                ->descriptionColor('success')
//                ->chart([7, 2, 10, 3, 15, 4, 17])
//                ->color('success'),
//
//            Stat::make(' الصف الاول الاعدادى',Child::where('education_id','8')->count())
//                ->description('اجمالى  المقيدين فى الصف الاول الاعدادى')
//                ->descriptionIcon('heroicon-o-users')
//                ->descriptionColor('primary')
//                ->chart([7, 2, 10, 3, 15, 4, 17])
//                ->color('primary'),
//            Stat::make(' الصف الثانى الاعدادى',Child::where('education_id','9')->count())
//                ->description('اجمالى  المقيدين فى الصف الثانى الاعدادى ')
//                ->descriptionIcon('heroicon-o-users')
//                ->descriptionColor('primary')
//                ->chart([7, 2, 10, 3, 15, 4, 17])
//                ->color('primary'),
//            Stat::make(' الصف الثالث الاعدادى',Child::where('education_id','10')->count())
//                ->description('اجمالى  المقيدين فى الصف الثالث الاعدادى')
//                ->descriptionIcon('heroicon-o-users')
//                ->descriptionColor('primary')
//                ->chart([7, 2, 10, 3, 15, 4, 17])
//                ->color('primary'),
//
//
//
//
//
//            Stat::make(' الصف الاول الثانوى',Child::where('education_id','11')->count())
//                ->description('اجمالى  المقيدين فى الصف الاول الثانوى')
//                ->descriptionIcon('heroicon-o-users')
//                ->descriptionColor('info')
//                ->chart([7, 2, 10, 3, 15, 4, 17])
//                ->color('info'),
//            Stat::make('  الصف الثانى الثانوى',Child::where('education_id','12')->count())
//                ->description('اجمالى  المقيدين فى الصف الثانى الثانوى')
//                ->descriptionIcon('heroicon-o-users')
//                ->descriptionColor('info')
//                ->chart([7, 2, 10, 3, 15, 4, 17])
//                ->color('info'),
//            Stat::make('  الصف الثالث الثانوى',Child::where('education_id','13')->count())
//                ->description('اجمالى  المقيدين فى الصف الثالث الثانوى')
//                ->descriptionIcon('heroicon-o-users')
//                ->descriptionColor('info')
//                ->chart([7, 2, 10, 3, 15, 4, 17])
//                ->color('info'),
//
//            Stat::make(' الجامعين',Child::where('education_id','14')->count())
//                ->description('اجمالى الجامعين المقيدين ')
//                ->descriptionIcon('heroicon-o-users')
//                ->descriptionColor('gray')
//                ->chart([7, 2, 10, 3, 15, 4, 17])
//                ->color('gray'),
//            Stat::make(' الخريجين',Child::where('education_id','15')->count())
//                ->description('اجمالى الخريجين المقيدين فى حضانة')
//                ->descriptionIcon('heroicon-o-users')
//                ->descriptionColor('gray')
//                ->chart([7, 2, 10, 3, 15, 4, 17])
//                ->color('gray'),

        ];
    }
}
