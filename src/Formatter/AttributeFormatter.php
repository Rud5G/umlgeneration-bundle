<?php
declare(strict_types=1);

namespace UMLGenerationBundle\Formatter;

use UMLGenerationBundle\Model\Attribute;

class AttributeFormatter
{
    /** @var array|string[] */
    private array $mapModifierToSymbol = [
        'private' => '-',
        'protected' => '#',
        'public' => '+',
    ];

    public function format(Attribute $attribute): string
    {
        $additionalInfo = '';
        if ($attribute->getAdditionalInfo()) {
            $additionalInfo = sprintf(' (%s)', $attribute->getAdditionalInfo());
        }

        if ($attribute->getDefaultValue()) {
            $additionalInfo .= sprintf(' = %s', $attribute->getDefaultValue());
        }

        return sprintf(
            <<<TABLEROW
            <tr><td%s>%s %s</td><td>%s%s</td></tr>
            TABLEROW,
            $this->tableColumnStyle($attribute),
            $this->mapModifierToSymbol[$attribute->getModifier()],
            $attribute->getName(),
            $attribute->getType(),
            $additionalInfo,
        );
    }

    proteted function tableColumnStyle(Attribute $attribute): string
    {
        return sprintf(' style="text-align:left;%s"', $attribute->isStatic() ? 'text-decoration: underline;' : '');
    }
}
