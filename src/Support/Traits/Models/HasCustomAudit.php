<?php

namespace Support\Traits\Models;

use Illuminate\Support\Facades\Event;
use OwenIt\Auditing\Events\AuditCustom;

trait HasCustomAudit
{
    public function audit(string $event, array $old, array $new)
    {
        $this->auditEvent = $event;
        $this->isCustomEvent = true;
        $this->auditCustomOld = $old;
        $this->auditCustomNew = $new;
        Event::dispatch(new AuditCustom($this));
    }
}
