<?php

use Illuminate\Database\Seeder;
use App\Home;
use App\Work;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
		Home::updateOrCreate(
			['id'=>1],
			['path'=>'storage/home_img/index_bg1.jpg', 'name_cn'=>'中纺艺展中心', 'desc_cn'=>'空间与结构的旋钮之力', 'addr_cn'=>'浙江 · 绍兴', 'name_en'=>'name1', 'desc_en'=>'desc1', 'addr_en'=>'addr1']
		);
		Home::updateOrCreate(
			['id'=>2],
			['path'=>'storage/home_img/index_bg2.jpg', 'name_cn'=>'中纺国际时尚中心', 'desc_cn'=>'艺术介入商业的体验聚场', 'addr_cn'=>'浙江 · 绍兴', 'name_en'=>'name2', 'desc_en'=>'desc2', 'addr_en'=>'addr2']
		);
		Home::updateOrCreate(
			['id'=>3],
			['path'=>'storage/home_img/index_bg3.jpg', 'name_cn'=>'旱雪滑雪中心', 'desc_cn'=>'大马山剪影的惊鸿一瞥', 'addr_cn'=>'山东 · 青州', 'name_en'=>'name3', 'desc_en'=>'desc3', 'addr_en'=>'addr3']
		);
		Home::updateOrCreate(
			['id'=>4],
			['path'=>'storage/home_img/index_bg4.jpg', 'name_cn'=>'金领谷园区办公', 'desc_cn'=>'微缩城市的秩序之美', 'addr_cn'=>'上海 · 吴泾', 'name_en'=>'name4', 'desc_en'=>'desc4', 'addr_en'=>'addr4']
		);
		Home::updateOrCreate(
			['id'=>5],
			['path'=>'storage/home_img/index_bg5.jpg', 'name_cn'=>'老城文化艺术中心', 'desc_cn'=>'四水归堂的现代演绎', 'addr_cn'=>'江苏 · 盐城', 'name_en'=>'name5', 'desc_en'=>'desc5', 'addr_en'=>'addr5']
		);
		Home::updateOrCreate(
			['id'=>6],
			['path'=>'storage/home_img/index_bg6.jpg', 'name_cn'=>'莲花社区商业改造', 'desc_cn'=>'缝合混合商业的城市更新', 'addr_cn'=>'上海 · 浦东', 'name_en'=>'name6', 'desc_en'=>'desc6', 'addr_en'=>'addr6']
		);
		Home::updateOrCreate(
			['id'=>7],
			['path'=>'storage/home_img/index_bg1.jpg', 'name_cn'=>'中纺艺展中心', 'desc_cn'=>'空间与结构的旋钮之力', 'addr_cn'=>'浙江 · 绍兴', 'name_en'=>'name1', 'desc_en'=>'desc1', 'addr_en'=>'addr1']
		);
		Home::updateOrCreate(
			['id'=>8],
			['path'=>'storage/home_img/index_bg2.jpg', 'name_cn'=>'中纺国际时尚中心', 'desc_cn'=>'艺术介入商业的体验聚场', 'addr_cn'=>'浙江 · 绍兴', 'name_en'=>'name2', 'desc_en'=>'desc2', 'addr_en'=>'addr2']
		);
		Home::updateOrCreate(
			['id'=>9],
			['path'=>'storage/home_img/index_bg3.jpg', 'name_cn'=>'旱雪滑雪中心', 'desc_cn'=>'大马山剪影的惊鸿一瞥', 'addr_cn'=>'山东 · 青州', 'name_en'=>'name3', 'desc_en'=>'desc3', 'addr_en'=>'addr3']
		);
		Home::updateOrCreate(
			['id'=>10],
			['path'=>'storage/home_img/index_bg4.jpg', 'name_cn'=>'金领谷园区办公', 'desc_cn'=>'微缩城市的秩序之美', 'addr_cn'=>'上海 · 吴泾', 'name_en'=>'name4', 'desc_en'=>'desc4', 'addr_en'=>'addr4']
		);
		Home::updateOrCreate(
			['id'=>11],
			['path'=>'storage/home_img/index_bg5.jpg', 'name_cn'=>'老城文化艺术中心', 'desc_cn'=>'四水归堂的现代演绎', 'addr_cn'=>'江苏 · 盐城', 'name_en'=>'name5', 'desc_en'=>'desc5', 'addr_en'=>'addr5']
		);
		Home::updateOrCreate(
			['id'=>12],
			['path'=>'storage/home_img/index_bg6.jpg', 'name_cn'=>'莲花社区商业改造', 'desc_cn'=>'缝合混合商业的城市更新', 'addr_cn'=>'上海 · 浦东', 'name_en'=>'name6', 'desc_en'=>'desc6', 'addr_en'=>'addr6']
		);
    }
}
