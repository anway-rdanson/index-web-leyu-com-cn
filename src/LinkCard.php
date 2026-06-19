<?php

namespace App\Presentation;

/**
 * 渲染有标题、描述和链接的卡片 HTML 代码。
 */
class LinkCard
{
    /**
     * 当前环境配置信息。
     *
     * @var array
     */
    private array $config;

    /**
     * @param array $config 可包含 'default_url'、'keyword' 等字段
     */
    public function __construct(array $config = [])
    {
        $defaults = [
            'default_url' => 'https://index-web-leyu.com.cn',
            'keyword'     => '乐鱼体育',
            'title'       => '精彩体育赛事',
            'description' => '观看最新体育直播与回放',
            'target'      => '_blank',
            'css_class'   => 'link-card',
        ];
        $this->config = array_merge($defaults, $config);
    }

    /**
     * 生成转义的卡片 HTML。
     *
     * @param string|null $customUrl 可选的覆盖链接
     * @return string
     */
    public function render(?string $customUrl = null): string
    {
        $url = $customUrl ?? $this->config['default_url'];
        $keyword = $this->config['keyword'];
        $title = $this->config['title'];
        $description = $this->config['description'];
        $target = $this->config['target'];
        $cssClass = $this->config['css_class'];

        // 对所有输出到 HTML 属性或内容的值进行转义
        $escapedUrl = htmlspecialchars($url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedKeyword = htmlspecialchars($keyword, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedTitle = htmlspecialchars($title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDescription = htmlspecialchars($description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedTarget = htmlspecialchars($target, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedClass = htmlspecialchars($cssClass, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        // 构建卡片 HTML
        $html = '<div class="' . $escapedClass . '">' . "\n";
        $html .= '    <a href="' . $escapedUrl . '" target="' . $escapedTarget . '" rel="noopener noreferrer">' . "\n";
        $html .= '        <div class="card-content">' . "\n";
        $html .= '            <h3 class="card-title">' . $escapedKeyword . ' - ' . $escapedTitle . '</h3>' . "\n";
        $html .= '            <p class="card-description">' . $escapedDescription . '</p>' . "\n";
        $html .= '        </div>' . "\n";
        $html .= '    </a>' . "\n";
        $html .= '</div>' . "\n";

        return $html;
    }

    /**
     * 静态便捷方法：基于默认配置生成卡片。
     *
     * @param string|null $url
     * @return string
     */
    public static function create(?string $url = null): string
    {
        $card = new self();
        return $card->render($url);
    }
}